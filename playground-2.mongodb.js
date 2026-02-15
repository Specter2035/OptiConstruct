/* global use, db */
// MongoDB Playground
// Use Ctrl+Space inside a snippet or a string literal to trigger completions.

const database = 'NominaDB';
const collection = 'Trabajadores';

// Create a new database.
use("NominaDB");

// Create a new collection.
//db.createCollection(collection);

// Uso de insertMany para agregar múltiples documentos a la colección "Trabajadores".
//$push – agregar elemento Agregar un nuevo pago:
/*
db.Trabajadores.updateOne(
  { _id: ObjectId("66b0a0010000000000000008") },
  {
    $push: {
      pagos: {
        fecha: ISODate("2025-09-01"),
        monto: NumberDecimal("4500"),
        metodo: "transferencia",
        folio: "FOL-CM-20250901-01",
        periodo: "2025-09",
        status: "pagado"
      }
    }
  }
)
  */

//________________________________________
//$addToSet – agregar sin duplicar
db.trabajadores.updateOne(
  { nombre: "Ana Pérez" },
  { $addToSet: { habilidades: "MongoDB" } }
)
/*
//________________________________________

//$pop – eliminar primer o último elemento Eliminar último pago:
db.trabajadores.updateOne(
  { nombre: "Ana Pérez" },
  { $pop: { pagos: 1 } }
)

//Eliminar primer pago:
db.trabajadores.updateOne(
  { nombre: "Ana Pérez" },
  { $pop: { pagos: -1 } }
)
//________________________________________
//$pull – eliminar elementos que cumplan condición

//Eliminar pagos pendientes:
db.trabajadores.updateMany(
  {},
  { $pull: { pagos: { status: "pendiente" } } }
)
//________________________________________
*/