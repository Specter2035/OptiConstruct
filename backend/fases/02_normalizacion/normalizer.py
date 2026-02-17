"""
Normalizer module

Responsibilities:
- Convert DXF units to meters
- Apply uniform scaling to geometries
- Normalize coordinates (rounding, origin shift if needed)
- Provide a single normalization entry point

This module MUST NOT:
- Interpret layers
- Detect walls or rooms
- Calculate measurements
"""

from typing import Iterable
from shapely.affinity import scale, translate
from shapely.geometry.base import BaseGeometry

# DXF $INSUNITS → meters conversion
DXF_UNIT_SCALE = {
    0: 1.0,        # Unitless (assume meters)
    1: 0.0254,     # Inches
    2: 0.3048,     # Feet
    3: 1609.344,   # Miles
    4: 0.001,      # Millimeters
    5: 0.01,       # Centimeters
    6: 1.0,        # Meters
    7: 1000.0,     # Kilometers
}


def get_unit_scale(insunits: int) -> float:
    """
    Return scale factor to convert DXF units to meters.
    Unknown units default to meters.
    """
    return DXF_UNIT_SCALE.get(insunits, 1.0)


def normalize_geometry(
    geom: BaseGeometry,
    scale_factor: float,
    precision: int = 4
) -> BaseGeometry:
    """
    Normalize a single geometry:
    - Scale to meters
    - Round coordinates to fixed precision
    """

    if geom.is_empty:
        return geom

    # Scale geometry to meters
    geom = scale(geom, xfact=scale_factor, yfact=scale_factor, origin=(0, 0))

    # Snap coordinates via rounding (numerical stability)
    geom = _round_geometry(geom, precision)

    return geom


def normalize_geometries(
    geometries: Iterable[BaseGeometry],
    scale_factor: float,
    precision: int = 4,
    shift_to_origin: bool = False
) -> list[BaseGeometry]:
    """
    Normalize a collection of geometries.

    Optional:
    - Shift all geometries so minimum X/Y = (0,0)
    """

    normalized = [
        normalize_geometry(g, scale_factor, precision)
        for g in geometries
        if g is not None and not g.is_empty
    ]

    if shift_to_origin and normalized:
        minx, miny, _, _ = _bounds(normalized)
        normalized = [
            translate(g, xoff=-minx, yoff=-miny)
            for g in normalized
        ]

    return normalized


def _round_geometry(geom: BaseGeometry, precision: int) -> BaseGeometry:
    """
    Round geometry coordinates without changing topology.
    """

    def _round_coords(coords):
        return [(round(x, precision), round(y, precision)) for x, y in coords]

    geom_type = geom.geom_type

    if geom_type == "LineString":
        return type(geom)(_round_coords(geom.coords))

    if geom_type == "Polygon":
        exterior = _round_coords(geom.exterior.coords)
        interiors = [
            _round_coords(ring.coords)
            for ring in geom.interiors
        ]
        return type(geom)(exterior, interiors)

    if geom_type.startswith("Multi") or geom_type == "GeometryCollection":
        return type(geom)([
            _round_geometry(g, precision) for g in geom.geoms
        ])

    return geom


def _bounds(geometries: Iterable[BaseGeometry]):
    """
    Compute global bounds for a geometry collection.
    """
    minx = min(g.bounds[0] for g in geometries)
    miny = min(g.bounds[1] for g in geometries)
    maxx = max(g.bounds[2] for g in geometries)
    maxy = max(g.bounds[3] for g in geometries)
    return minx, miny, maxx, maxy
