/* CREATION PLAYER TOWN SPORT MATCH_RESULT REVIEW
INSERT INTO town (town) VALUES ('Caen');
INSERT INTO review (review_value,review_text) VALUES (5,'super');
INSERT INTO player (mail,password,first_name,last_name,photo_url,age,number_match_played,health,review_id,town_id) VALUES ('toto1@gmail.com','d123','toto','no last name','one',33,0,'d',1,1);
INSERT INTO sport (sport_name) VALUES ('foot-ball');
INSERT INTO match_result (score_match, duration, best_player) VALUES ('0-0', '10:00:00', 'toto1@gmail.com');
INSERT INTO match (number_max_player,number_min_player,date,hour,adress,duration,price,registered_count,title,age_range,match_description,winner,organizer_id,sport_id,match_id_match_result,town_id) VALUES (10,2,'06-15-2022','12:00:00','Nantes','01:00:00',0,1,'évènementA','9-50','description sommaire','','toto1@gmail.com',1,1,1); 
*/


/*
OTHER PLAYER
INSERT INTO review (review_value,review_text) VALUES (2,'bof');
INSERT INTO player (mail,password,first_name,last_name,photo_url,age,number_match_played,health,review_id,town_id) VALUES ('toto2@gmail.com','s123','fils de toto','no last name','one','10',0,'d',1,1);
*/

/*TEST*/

/*
SELECT m.match_id, m.title, s.sport_name, t.town, m.date, m.hour, m.number_max_player FROM match m, sport s, town t WHERE m.sport_id = s.sport_id AND m.town_id = t.town_id;
SELECT match_id, title FROM match;
SELECT match_id, title FROM match WHERE organizer_id = 'toto1@gmail.com';
*/


