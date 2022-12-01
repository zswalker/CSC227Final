create table if not exists inventory(id serial primary key, car_year YEAR not null, make varchar(30) not null, model varchar(30) not null, car_type varchar(30) not null, miles int(6) not null, price int(8) not null);

insert into inventory(car_year, make, model, car_type, miles, price) values
  (2005, 'Chevy', 'Silverado', 'Truck', 101050, 58000),
  (2008, 'Ford', 'Mustang GT', 'Coupe', 65658, 16800),
  (1980, 'Chevy', 'Corvette','Coupe', 95000, 22500),
  (2019, 'Honda', 'Civic Type R', 'Sedan', 21800, 35899),
  (2022, 'Acura', 'NSX', 'Coupe', 20, 171400);
