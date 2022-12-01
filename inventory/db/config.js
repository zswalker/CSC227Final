require('dotenv').config();
const DB_CONFIG = process.env.DB_CONFIG || 'postgresql://inventory:inventory@localhost:5432/inventory';
const { Pool } = require('pg');

const pgconn = new Pool({
    connectionString: DB_CONFIG,
    ssl: false,
});
  
module.exports = { pgconn }