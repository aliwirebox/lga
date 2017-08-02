UPDATE searches SET vacancy_location_id = 1;

INSERT INTO candidate_location (candidate_id, location_id) 
SELECT id, 1 FROM candidates;
