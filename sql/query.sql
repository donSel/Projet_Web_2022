SELECT m.match_id, m.title, s.sport_name, t.town, m.date, m.hour, m.number_max_player FROM match m, sport s, town t WHERE m.sport_id = s.sport_id AND m.town_id = t.town_id;
