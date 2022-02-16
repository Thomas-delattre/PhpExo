#SELECTION DE TOUTES LES RESERVATIONS DU SITE 
SELECT rooms.name, rooms.duration, booking.date, schedule.heure, customers.firstname, customers.lastname, customers.email
FROM `booking`, schedule, customers, rooms
WHERE rooms.id = booking.room_id
AND schedule.id = booking.schedule_id
AND customers.id = booking.customer_id;


#SELECTION DES RESERVATIONS DU SITE SUR LE MOIS EN COURS
SELECT MONTH(booking.date) as month_booking, rooms.name, rooms.duration, booking.date, schedule.heure, customers.firstname, customers.lastname, customers.email 
FROM `booking`, schedule, customers, rooms
WHERE rooms.id = booking.room_id 
AND schedule.id = booking.schedule_id 
AND customers.id = booking.customer_id 
AND MONTH(booking.date) = MONTH(CURRENT_DATE);

#SOMME DES RESERVATIONS PAR MOIS
SELECT MONTH(booking.date) as month_booking, SUM(booking.total_price) 
FROM `booking`;

#SOMME DES RESERVATIONS PAR MOIS ET CLIENT
SELECT customer_id, MONTH(booking.date) as month_booking, SUM(booking.total_price) 
FROM `booking`
GROUP BY booking.customer_id, MONTH(booking.date);
