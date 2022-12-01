const express = require('express');
const router = express.Router();
const { pgconn } = require('../db/config')

/* Show home page. */
router.get('/', function(req, res) {
  // we first check if the 'inventory' table exists
  pgconn.query("SELECT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_name = 'inventory')", function(err,results) {
    if (err) {
      console.log(err);
      res.render('index', { error: 'Database connection failure! '+err.stack, inventory: null, title: 'Inventory List' });
    }

    // 'inventory' table does not exist. Show an empty table.
    else if(results.rows[0].exists == false) {
      res.render('index', { error: null, inventory: null, title: 'Inventory List' });
    }

    // 'inventory' table exists. Show the records.
    else {
      pgconn.query('SELECT * FROM inventory', function(err,results) {
        if (err) {
          console.log(err);
          res.render('index', { error: 'Database connection failure! '+err.stack, inventory: null, title: 'Inventory List' });
        }
        else {
          let inventory = results.rows;
          console.log(inventory);
          res.render('index', { error: null, inventory: inventory, title: 'Inventory List' });
        }
      })  
    }
  });
});

/* Seed test data */
router.post('/seed', function(req,res) {
  // drop 'inventory' table if already exists, and seed some test data
  pgconn.query("drop table if exists inventory; create table inventory(id serial primary key, car_year YEAR not null, make varchar(30) not null, model varchar(30) not null, car_type varchar(30) not null, miles int(6) not null, price int(8) not null)",function(err,results) {
    if (err) {
      console.log(err);
      res.render('index', { error: 'Seeding database failure! '+err.stack, inventory: null, title: 'Inventory List' });
    }

    // redirect to the index page
    else {
      res.redirect('/');
    }
  });
});

module.exports = router;
