.
├── __init__.py
├── __pycache__
│   └── __init__.cpython-38.pyc
├── blueprints
│   ├── ##1100-sq.-ft.Small-Cabin-3-Bedrooms.dxf
│   ├── ##call-center-offices.dxf
│   ├── #1100-sq.-ft.Small-Cabin-3-Bedrooms.dxf
│   ├── #House-complete-project.dxf
│   ├── #call-center-offices.dxf
│   ├── 1100-sq.-ft.Small-Cabin-3-Bedrooms.dxf
│   ├── House-complete-project.dxf
│   └── call-center-offices.dxf
├── config
│   ├── README.md
│   ├── canonical_catalog.yml
│   ├── defaults.yml
│   └── layers.yml
├── core
│   ├── __init__.py
│   └── __pycache__
│       ├── __init__.cpython-38.pyc
│       ├── canonical.cpython-38.pyc
│       ├── loader.cpython-312.pyc
│       └── loader.cpython-38.pyc
├── domain
│   ├── opening.py
│   ├── room.py
│   ├── slab.py
│   └── wall.py
├── fases
│   ├── 01_carga_dxf
│   │   └── loader.py
│   ├── 02_normalizacion
│   │   └── normalizer.py
│   ├── 03_interpretacion_capas
│   │   ├── canonical.py
│   │   └── layer_map.py
│   ├── 04_extraccion_geometria
│   ├── 05_objetos_dominio
│   ├── 06_mediciones
│   ├── 07_validacion
│   └── 08_exportacion
├── geometry
│   ├── cleaners.py
│   ├── converters.py
│   └── offsets.py
├── main.py
├── measurements
│   ├── global_metrics.py
│   ├── room_metrics.py
│   └── wall_metrics.py
├── output
│   ├── exporters.py
│   └── quantities.py
├── src
│   ├── app
│   ├── controllers
│   ├── db
│   ├── routes
│   ├── services
│   │   ├── engineClient
│   │   ├── geolocation
│   │   └── pricing
│   ├── utils
│   └── validators
├── structure.txt
├── structure1.py
├── test_loader.py
├── tests
└── validation
    ├── blueprint_checks.py
    └── geometry_checks.py

31 directories, 41 files
