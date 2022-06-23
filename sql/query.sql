 -- [ TESTs ] --
/*
INSERT INTO review (review_value,review_text) VALUES (2,'bof');
INSERT INTO player (mail,password,first_name,last_name,photo_url,age,number_match_played,health,review_id,town_id) VALUES ('mickael.neroda@gmail.com','s123','fils de toto','no last name','one','10',0,'d',1,1);
*/

/*
SELECT m.match_id, m.title, s.sport_name, t.town, m.date, m.hour, m.number_max_player 
                                FROM match m, sport s, town t 
                                WHERE m.sport_id = s.sport_id AND m.town_id = '*' AND m.date - NOW() > 0 AND ((m.number_max_player=registered_count)=*);
*/


SELECT m.match_id, m.title, m.match_description, o.last_name, o.photo_url, m.address, m.hour, m.duration, m.price, m.number_max_player, m.registered_count 
FROM match m, player o 
WHERE (m.match_id = 3 OR m.match_id = 2) AND o.mail = 'mickael.neroda@gmail.com';

/*SELECT m.match_id, m.title, m.match_description, o.last_name, o.photo_url, m.address, m.hour, m.duration, m.price, m.number_max_player, m.registered_count 
FROM match m, player o 
WHERE m.match_id = 2 AND o.mail = 'mickael.neroda@gmail.com';*/





