import ezdxf

INSUNITS_MAP = {
    0: None,
    1: 0.0254,
    2: 0.3048,
    4: 0.001,
    5: 0.01,
    6: 1.0
}

def load_dxf(path):
    try:
        doc = ezdxf.readfile(path)
    except Exception as e:
        raise ValueError(f"DXF load failed: {e}")

    msp = doc.modelspace()
    units_code = doc.header.get('$INSUNITS', 0)
    scale = INSUNITS_MAP.get(units_code)

    units = {
        "code": units_code,
        "scale_to_meters": scale
    }

    return doc, msp, units
