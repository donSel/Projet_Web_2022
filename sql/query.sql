

/*
*/

INSERT INTO town (town) VALUES ('Caen');
INSERT INTO review (review_value,review_text) VALUES (5,'super');



/*
OTHER PLAYER
INSERT INTO review (review_value,review_text) VALUES (2,'bof');
INSERT INTO player (mail,password,first_name,last_name,photo_url,age,number_match_played,health,review_id,town_id) VALUES ('toto2@gmail.com','s123','fils de toto','no last name','one','10',0,'d',1,1);
*/


/*TEST
*/
INSERT INTO player (mail, password, first_name, last_name, photo_url, age, health, number_match_played, review_id, town_id) 
VALUES ('mickael.neroda@gmail.Com', 'aze', 'mickael', 'neroda', 'url', -1, -1, 0, 1, 1);


                    
/*
INSERT INTO review (review_value, review_text) VALUES (-1, '');
SELECT * FROM player WHERE mail='Bertrand.RIESSE@gmail.com';
INSERT INTO town (town) VALUES ('nantes');
SELECT m.match_id, m.title, s.sport_name, m.date, m.hour, m.number_min_player, m.number_max_player, m.registered_count
FROM match m, sport s
WHERE m.organizer_id='toto1@gmail.com' AND s.sport_id=m.sport_id;

SELECT m.match_id, m.title, s.sport_name, t.town, m.date, m.hour, m.number_max_player FROM match m, sport s, town t WHERE m.sport_id = s.sport_id AND m.town_id = t.town_id;
SELECT match_id, title FROM match;
SELECT match_id, title FROM match WHERE organizer_id = 'toto1@gmail.com';
*/


