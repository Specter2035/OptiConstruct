# backend/core/canonical.py
from __future__ import annotations

from dataclasses import dataclass
from pathlib import Path
from typing import Dict, List, Literal, Optional, Tuple

import yaml

QuantityBasis = Literal["length_m", "area_m2", "volume_m3", "count", "none"]


class CanonicalCatalogError(ValueError):
    pass


@dataclass(frozen=True)
class CanonicalMaterial:
    canonical_id: str
    label_es: str
    group: str
    quantity_basis: QuantityBasis
    keywords: Tuple[str, ...] = ()


@dataclass(frozen=True)
class CanonicalCatalog:
    version: int
    locale_default: str
    materials: Dict[str, CanonicalMaterial]


_CACHED: Optional[CanonicalCatalog] = None


def load_catalog(path: str | Path) -> CanonicalCatalog:
    """
    Load and validate the simplified canonical catalog YAML.
    This is the ONLY function that should read the YAML file.
    """
    p = Path(path)
    if not p.exists():
        raise CanonicalCatalogError(f"Catalog file not found: {p}")

    data = yaml.safe_load(p.read_text(encoding="utf-8"))
    if not isinstance(data, dict):
        raise CanonicalCatalogError("Catalog root must be a mapping/dict.")

    for key in ("version", "locale_default", "materials"):
        if key not in data:
            raise CanonicalCatalogError(f"Missing top-level key: {key}")

    raw_mats = data["materials"]
    if not isinstance(raw_mats, list):
        raise CanonicalCatalogError("'materials' must be a list.")

    mats: Dict[str, CanonicalMaterial] = {}

    for raw in raw_mats:
        if not isinstance(raw, dict):
            raise CanonicalCatalogError("Each material must be a mapping/dict.")

        cid = str(raw.get("canonical_id", "")).strip()
        if not cid:
            raise CanonicalCatalogError("Material missing required field 'canonical_id'.")
        if cid in mats:
            raise CanonicalCatalogError(f"Duplicate canonical_id: {cid}")

        label_es = str(raw.get("label_es", "")).strip()
        if not label_es:
            raise CanonicalCatalogError(f"{cid}: missing required field 'label_es'.")

        group = str(raw.get("group", "")).strip()
        if not group:
            raise CanonicalCatalogError(f"{cid}: missing required field 'group'.")

        qb = str(raw.get("quantity_basis", "")).strip()
        allowed = {"length_m", "area_m2", "volume_m3", "count", "none"}
        if qb not in allowed:
            raise CanonicalCatalogError(
                f"{cid}: invalid quantity_basis '{qb}'. Allowed: {sorted(allowed)}"
            )

        # Optional keywords: normalize to uppercase tuple for consistent matching
        kw = raw.get("keywords", [])
        if kw is None:
            kw_list: List[str] = []
        elif isinstance(kw, (list, tuple)):
            kw_list = [str(x).strip() for x in kw if str(x).strip()]
        else:
            raise CanonicalCatalogError(f"{cid}: 'keywords' must be a list of strings if present.")
        kw_tuple = tuple(k.upper() for k in kw_list)

        mats[cid] = CanonicalMaterial(
            canonical_id=cid,
            label_es=label_es,
            group=group,
            quantity_basis=qb,  # type: ignore[assignment]
            keywords=kw_tuple,
        )

    return CanonicalCatalog(
        version=int(data["version"]),
        locale_default=str(data["locale_default"]),
        materials=mats,
    )


def init_catalog(path: str | Path = "backend/config/canonical_catalog.yml") -> CanonicalCatalog:
    """
    Load once and cache. Call this at app startup.
    """
    global _CACHED
    _CACHED = load_catalog(path)
    return _CACHED


def get_catalog() -> CanonicalCatalog:
    """
    Get cached catalog. Requires init_catalog() to have run.
    """
    if _CACHED is None:
        raise CanonicalCatalogError("Catalog not initialized. Call init_catalog() at startup.")
    return _CACHED


def get_dropdown(include_unknown: bool = False) -> List[dict]:
    """
    Returns a list for UI dropdowns:
      [{"id": "<canonical_id>", "label": "<Spanish label>", "group": "<group>"}]
    """
    cat = get_catalog()
    items: List[dict] = []

    for m in cat.materials.values():
        if not include_unknown and m.canonical_id == "unknown":
            continue
        items.append({"id": m.canonical_id, "label": m.label_es, "group": m.group})

    items.sort(key=lambda x: (x["group"], x["label"]))
    return items


def get_keywords() -> Dict[str, Tuple[str, ...]]:
    """
    Returns keyword suggestions mapping:
      {"WALL": ("MURO", "WALL", ...), ...}
    Intended for mapping suggestions from layer names.
    """
    cat = get_catalog()
    return {cid: m.keywords for cid, m in cat.materials.items() if m.keywords}


def get_material(canonical_id: str) -> CanonicalMaterial:
    cat = get_catalog()
    try:
        return cat.materials[canonical_id]
    except KeyError:
        raise CanonicalCatalogError(f"Unknown canonical_id: {canonical_id}")


def list_by_group(group: str) -> List[dict]:
    """
    Returns items in a given group for UI filtering.
    """
    cat = get_catalog()
    out: List[dict] = []

    for m in cat.materials.values():
        if m.group != group:
            continue
        out.append({"id": m.canonical_id, "label": m.label_es})

    out.sort(key=lambda x: x["label"])
    return out
