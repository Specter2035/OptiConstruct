# backend/core/canonical.py
from __future__ import annotations

from dataclasses import dataclass
from pathlib import Path
from typing import Dict, List, Literal, Optional, Tuple

import yaml

QuantityBasis = Literal["length_m", "area_m2", "volume_m3", "count", "none"]
Kind = Literal["element", "finish", "system", "meta"]
Status = Literal["active", "deprecated"]


class CanonicalCatalogError(ValueError):
    pass


@dataclass(frozen=True)
class ParameterDef:
    key: str
    unit: str
    value_type: str
    min: Optional[float] = None
    max: Optional[float] = None
    description_es: Optional[str] = None
    description_en: Optional[str] = None


@dataclass(frozen=True)
class CanonicalMaterial:
    canonical_id: str
    labels: Dict[str, str]  # e.g. {"es": "Losa"}
    kind: Kind
    group: str
    measurable_in_v1: bool
    quantity_basis: QuantityBasis
    supports_secondary_basis: List[QuantityBasis]
    required_parameters: List[str]
    optional_parameters: List[str]
    expected_geometry: List[str]
    strategy_hint: Optional[str] = None
    status: Status = "active"
    notes: Optional[str] = None

    # Optional Phase-3 UX: keyword-based mapping suggestions
    keywords: Tuple[str, ...] = ()


@dataclass(frozen=True)
class CanonicalCatalog:
    version: int
    locale_default: str
    parameters: Dict[str, ParameterDef]
    materials: Dict[str, CanonicalMaterial]


_CACHED: Optional[CanonicalCatalog] = None


def load_catalog(path: str | Path) -> CanonicalCatalog:
    """
    Load and validate the canonical catalog YAML.
    This is the ONLY function that should read the YAML file.
    """
    p = Path(path)
    if not p.exists():
        raise CanonicalCatalogError(f"Catalog file not found: {p}")

    data = yaml.safe_load(p.read_text(encoding="utf-8"))
    if not isinstance(data, dict):
        raise CanonicalCatalogError("Catalog root must be a mapping/dict.")

    for key in ("version", "locale_default", "parameters", "materials"):
        if key not in data:
            raise CanonicalCatalogError(f"Missing top-level key: {key}")

    # -------- Parameters --------
    raw_params = data["parameters"]
    if not isinstance(raw_params, list):
        raise CanonicalCatalogError("'parameters' must be a list.")

    params: Dict[str, ParameterDef] = {}
    for raw in raw_params:
        if not isinstance(raw, dict):
            raise CanonicalCatalogError("Each parameter must be a mapping/dict.")
        if "key" not in raw:
            raise CanonicalCatalogError("Parameter missing required field 'key'.")

        key = str(raw["key"]).strip()
        if not key:
            raise CanonicalCatalogError("Parameter 'key' cannot be empty.")
        if key in params:
            raise CanonicalCatalogError(f"Duplicate parameter key: {key}")

        params[key] = ParameterDef(
            key=key,
            unit=str(raw.get("unit", "")).strip(),
            value_type=str(raw.get("value_type", "")).strip(),
            min=raw.get("min"),
            max=raw.get("max"),
            description_es=raw.get("description_es"),
            description_en=raw.get("description_en"),
        )

    # -------- Materials --------
    raw_mats = data["materials"]
    if not isinstance(raw_mats, list):
        raise CanonicalCatalogError("'materials' must be a list.")

    mats: Dict[str, CanonicalMaterial] = {}
    for raw in raw_mats:
        if not isinstance(raw, dict):
            raise CanonicalCatalogError("Each material must be a mapping/dict.")

        cid = raw.get("canonical_id")
        if not cid:
            raise CanonicalCatalogError("Material missing required field 'canonical_id'.")
        cid = str(cid).strip()
        if not cid:
            raise CanonicalCatalogError("Material 'canonical_id' cannot be empty.")
        if cid in mats:
            raise CanonicalCatalogError(f"Duplicate canonical_id: {cid}")

        labels = raw.get("labels", {})
        if not isinstance(labels, dict) or not labels:
            raise CanonicalCatalogError(
                f"{cid}: 'labels' must be a non-empty dict (e.g. labels: {{es: '...'}})."
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
            labels={str(k): str(v) for k, v in labels.items()},
            kind=raw["kind"],
            group=str(raw["group"]),
            measurable_in_v1=bool(raw["measurable_in_v1"]),
            quantity_basis=raw["quantity_basis"],
            supports_secondary_basis=list(raw.get("supports_secondary_basis", [])),
            required_parameters=list(raw.get("required_parameters", [])),
            optional_parameters=list(raw.get("optional_parameters", [])),
            expected_geometry=list(raw.get("expected_geometry", [])),
            strategy_hint=raw.get("strategy_hint"),
            status=raw.get("status", "active"),
            notes=raw.get("notes"),
            keywords=kw_tuple,
        )

    # Cross-validation: referenced parameters must exist
    for cid, m in mats.items():
        for pk in (m.required_parameters + m.optional_parameters):
            if pk not in params:
                raise CanonicalCatalogError(f"{cid} references unknown parameter: {pk}")

    return CanonicalCatalog(
        version=int(data["version"]),
        locale_default=str(data["locale_default"]),
        parameters=params,
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


def get_dropdown(locale: str = "es", include_unknown: bool = False) -> List[dict]:
    """
    Returns a list for UI dropdowns:
      [{"id": "<canonical_id>", "label": "<localized label>", "group": "<group>", "kind": "<kind>"}]
    """
    cat = get_catalog()
    items: List[dict] = []

    for m in cat.materials.values():
        if m.status != "active":
            continue
        if not include_unknown and m.canonical_id == "unknown":
            continue

        label = m.labels.get(locale) or m.labels.get(cat.locale_default) or m.canonical_id
        items.append({"id": m.canonical_id, "label": label, "group": m.group, "kind": m.kind})

    items.sort(key=lambda x: (x["group"], x["label"]))
    return items


def get_keywords() -> Dict[str, Tuple[str, ...]]:
    """
    Returns keyword suggestions mapping:
      {"slab": ("LOSA", "SLAB", ...), ...}
    Intended for Phase 3 mapping suggestions from layer names.
    """
    cat = get_catalog()
    return {cid: m.keywords for cid, m in cat.materials.items() if m.keywords}


def get_material(canonical_id: str) -> CanonicalMaterial:
    cat = get_catalog()
    try:
        return cat.materials[canonical_id]
    except KeyError:
        raise CanonicalCatalogError(f"Unknown canonical_id: {canonical_id}")


def list_by_group(group: str, locale: str = "es") -> List[dict]:
    cat = get_catalog()
    out: List[dict] = []

    for m in cat.materials.values():
        if m.group != group or m.status != "active":
            continue
        label = m.labels.get(locale) or m.labels.get(cat.locale_default) or m.canonical_id
        out.append({"id": m.canonical_id, "label": label, "kind": m.kind})

    out.sort(key=lambda x: x["label"])
    return out
