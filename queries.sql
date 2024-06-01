-- Q1 What is the total number of Pokémon currently in the Pokédex?
SELECT COUNT(DISTINCT name) as total_pokemon_count FROM pokedex;


-- Q2: Which Pokémon has the highest Attack stat amongst Legendary Pokémon? Which one has the highest Attack stat amongst non-Legendary Pokémon?
-- legendary
SELECT 
	name,
    attack
FROM pokedex
WHERE attack = (SELECT
       MAX(attack)
      FROM pokedex
      WHERE legendary = 1)
      
-- non legendary
SELECT 
	name,
    attack
FROM pokedex
WHERE attack = (SELECT
       MAX(attack)
      FROM pokedex
      WHERE legendary = 0)

-- Q3: How many Pokémon are exclusively "Fire" types?
SELECT 
name
FROM `pokedex` 
WHERE type_1 = 'Fire' AND type_2 IS NULL;

-- Q4: What are the names and attack stats of all the Legendary Pokémon in Generation 7?
SELECT 
DISTINCT name,
attack
FROM `pokedex` 
WHERE generation = 7 AND legendary = true

--Q5: What is the average defense stat of all the Pokémon?
SELECT
	AVG(defense) as avg_defense
FROM pokedex


-- Q6: What are the names and types of all of the non-Legendary Pokémon with a speed greater than 120?
SELECT
	name,
    type_1,
    type_2
FROM pokedex
WHERE speed > 120 AND legendary = false

-- Q7: Which five (5) Pokémon have the highest HP (Hit Points) amongst all 'Water' types?
SELECT 
    name,
    hp
FROM pokedex
WHERE type_1 = 'Water'
ORDER BY hp DESC
LIMIT 5 

-- Q8: What is the total number of Pokémon in each generation?
SELECT 
	generation,
	COUNT(DISTINCT name) as pokemon_count
 FROM pokedex
 GROUP BY generation


 -- Q9: What are the names of Pokémon that have both "Ghost" and "Fairy" as their types?
 SELECT 
	name,
    type_1,
    type_2
FROM pokedex
WHERE (type_1 = 'Ghost' AND type_2 = 'Fairy') OR (type_1 = 'Fairy' AND type_2 = 'Ghost')

--Q10: What is the average HP, attack, and defense stats of the Pokémon belonging to the "Grass" type?
SELECT 
	AVG(hp) as avg_hp,
    AVG(attack) as avg_attack,
    AVG(defense) as avg_defense
FROM pokedex
WHERE type_1 = 'Grass'

--Q11: Increment Sprigatito speed stat by 10 and display the updated entry to the user.
INSERT INTO pokedex (name, type_1, type_2, hp, attack, defense, speed, special_attack, special_defense, generation, legendary) VALUES
    ('Sprigatito', 'Grass', NULL, 40, 61, 54, 65, 45, 45, 9, false)

SELECT * 
FROM `pokedex` 
WHERE name = 'Sprigatito'


--Q12. Increment Sprigatito speed stat by 10 and display the updated entry to the user.
UPDATE pokedex
SET speed = speed + 10
WHERE name = 'Sprigatito'

--Q13. Delete Sprigatito from the Pokédex and try to display it to the user.
DELETE FROM pokedex
WHERE name = 'Sprigatito'


