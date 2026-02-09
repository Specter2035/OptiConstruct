from core.loader import load_dxf
from collections import Counter

DXF_PATH = "blueprints/House-complete-project.dxf"   

def main():
    doc, msp, units = load_dxf(DXF_PATH)

    print("DXF loaded successfully")
    print("Units:", units)
    print("Entity count:", sum(1 for _ in msp))
    
    if units["scale_to_meters"] is None:
        print("WARNING: Drawing has no defined units")
    
    types = Counter(e.dxftype() for e in msp)

    print("Entity types:")
    for t, c in types.items():
        print(f"  {t}: {c}")

if __name__ == "__main__":
    main()



