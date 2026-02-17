from backend.core.canonical import init_catalog, get_dropdown, get_keywords

init_catalog("backend/config/canonical_catalog.yml")

print("DROPDOWN:")
print(get_dropdown())

print("\nKEYWORDS:")
print(get_keywords())
