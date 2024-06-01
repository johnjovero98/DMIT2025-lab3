<?php
include('includes/header.php');
?>

<main class="container-xxl d-md-flex align-items-start p-3 gap-3">
    <div class="accordion mb-5" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <strong>1. What is the total number of Pokémon currently in the Pokédex?</strong>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <section class="mb-3">
                        <?php
                        $sql = "SELECT COUNT(DISTINCT name) as total_pokemon_count FROM pokedex;";
                        $result = mysqli_query($connection, $sql);
                        ?>

                        <?php if (mysqli_num_rows($result) > 0) : $row = mysqli_fetch_assoc($result) ?>
                            <p>The total number of pokemon in the pokedex is <span class="fw-bold"><?php echo $row['total_pokemon_count'] ?></span></p>
                        <?php else : ?>
                            <p>No data found</p>
                        <?php endif ?>
                    </section>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <strong>2. Which Pokémon has the highest Attack stat amongst Legendary Pokémon? Which one has the highest Attack stat amongst non-Legendary Pokémon?</strong>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    $sql = "SELECT name, attack FROM pokedex  WHERE attack = (SELECT MAX(attack) FROM pokedex WHERE legendary = 1)";
                    $result = mysqli_query($connection, $sql);
                    ?>

                    <?php if (mysqli_num_rows($result) > 0) :  $row = mysqli_fetch_assoc($result) ?>
                        <p>The Legendary Pokemon with the highest attack is <span class="fw-bold"><?php echo $row['name'] ?></span>, with a stat of <span class="fw-bold"><?php echo $row['attack'] ?></span>!</p>
                    <?php else : ?>
                        <p>No data found</p>
                    <?php endif ?>

                    <!-- non-legendary -->
                    <?php
                    $sql = "SELECT name, attack FROM pokedex  WHERE attack = (SELECT MAX(attack) FROM pokedex WHERE legendary = 0)";
                    $result = mysqli_query($connection, $sql);
                    ?>

                    <?php if (mysqli_num_rows($result) > 0) :  $row = mysqli_fetch_assoc($result) ?>
                        <p>The non-legendary Pokemon with the highest attack is <span class="fw-bold"><?php echo $row['name'] ?></span>, with a stat of <span class="fw-bold"><?php echo $row['attack'] ?></span>!</p>
                    <?php else : ?>
                        <p>No data found</p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <strong>3. How many Pokémon are exclusively "Fire" types?</strong>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    $sql = "SELECT COUNT(name) as pure_firetype_counts FROM `pokedex` WHERE type_1 = 'Fire' AND type_2 IS NULL;";
                    $result = mysqli_query($connection, $sql);
                    ?>

                    <?php if (mysqli_num_rows($result) > 0) :  $row = mysqli_fetch_assoc($result) ?>
                        <p>There are <span class="fw-bold"><?php echo $row['pure_firetype_counts'] ?></span> pure fire type pokemons!</p>
                    <?php else : ?>
                        <p>No data found</p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <strong>4. What are the names and attack stats of all the Legendary Pokémon in Generation 7?</strong>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    $sql = "SELECT DISTINCT name,  attack  FROM `pokedex`  WHERE generation = 7 AND legendary = true";
                    $result = mysqli_query($connection, $sql);
                    ?>

                    <table class="table w-auto">
                        <thead>
                            <th>Pokemon</th>
                            <th>Attack</th>
                        </thead>

                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['attack'] ?></td>
                                    </tr>
                                <?php endwhile ?>
                            <?php else : ?>
                                <tr>
                                    <td>No data Found</td>
                                    <td></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <strong>5. What is the average defense stat of all the Pokémon?</strong>
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    $sql = "SELECT AVG(defense) as avg_defense FROM pokedex";
                    $result = mysqli_query($connection, $sql);
                    ?>


                    <?php if (mysqli_num_rows($result) > 0) :  $row = mysqli_fetch_assoc($result) ?>
                        <p><span class="fw-bold"><?php echo number_format($row['avg_defense'], 2) ?></span> is the average defense of all pokemon recorded in this pokedex. </p>
                    <?php else : ?>
                        <p>No data found</p>
                    <?php endif ?>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <strong>6. What are the names and types of all of the non-Legendary Pokémon with a speed greater than 120?</strong>
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    $sql = "SELECT name, type_1, type_2 FROM pokedex WHERE speed > 120 AND legendary = false";
                    $result = mysqli_query($connection, $sql);
                    ?>

                    <table class="table w-auto">
                        <thead>
                            <th>Pokemon</th>
                            <th>Type</th>
                        </thead>

                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>
                                            <span><?php echo $row['type_1'] ?></span>
                                            <span><?php echo $row['type_2'] ?></span>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            <?php else : ?>
                                <tr>
                                    <td>No data Found</td>
                                    <td></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    <strong>7. Which five (5) Pokémon have the highest HP (Hit Points) amongst all 'Water' types?</strong>
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    $sql = "SELECT name FROM pokedex WHERE type_1 = 'Water' ORDER BY hp DESC LIMIT 5 ";
                    $result = mysqli_query($connection, $sql);
                    ?>
                    <table class="table w-auto">
                        <thead>
                            <th>Pokemon</th>
                        </thead>

                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?php echo $row['name'] ?></td>
                                    </tr>
                                <?php endwhile ?>
                            <?php else : ?>
                                <tr>
                                    <td>No data Found</td>
                                    <td></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    <strong>8. What is the total number of Pokémon in each generation?</strong>
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    $sql = "SELECT  generation, COUNT(DISTINCT name) as pokemon_count FROM pokedex  GROUP BY generation";
                    $result = mysqli_query($connection, $sql);
                    ?>

                    <table class="table w-auto">
                        <thead>
                            <th>Generation</th>
                            <th>Total number of Pokemon</th>
                        </thead>

                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td>Gen. <?php echo $row['generation'] ?></td>
                                        <td><?php echo $row['pokemon_count'] ?></td>
                                    </tr>
                                <?php endwhile ?>
                            <?php else : ?>
                                <tr>
                                    <td>No data Found</td>
                                    <td></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    <strong>9. What are the names of Pokémon that have both "Ghost" and "Fairy" as their types?</strong>
                </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    $sql = "SELECT name,  type_1, type_2 FROM pokedex
                        WHERE (type_1 = 'Ghost' AND type_2 = 'Fairy') OR (type_1 = 'Fairy' AND type_2 = 'Ghost')";
                    $result = mysqli_query($connection, $sql);

                    ?>
                    <table class="table w-auto">
                        <thead>
                            <th>Pokemon</th>
                            <th>Types</th>
                        </thead>

                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>(<?php echo $row['type_1'] ?>,<?php echo $row['type_2'] ?>)</td>
                                    </tr>
                                <?php endwhile ?>
                            <?php else : ?>
                                <tr>
                                    <td>No data Found</td>
                                    <td></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                    <strong>10. What is the average HP, attack, and defense stats of the Pokémon belonging to the "Grass" type?</strong>
                </button>
            </h2>
            <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php $sql = "SELECT
                            AVG(hp) as avg_hp,
                            AVG(attack) as avg_attack,
                            AVG(defense) as avg_defense
                            FROM pokedex
                            WHERE type_1 = 'Grass'";

                    $result = mysqli_query($connection, $sql);

                    ?>
                    <table class="table w-auto">
                        <thead>
                            <th>Grass Type Stats Summary</th>
                            <th> </th>
                        </thead>

                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <th>Average HP</th>
                                        <td><?php echo  number_format($row['avg_hp'], 2)  ?></td>
                                    </tr>
                                    <tr>
                                        <th>Average Attack</th>
                                        <td><?php echo  number_format($row['avg_attack'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Average Defense</th>
                                        <td><?php echo  number_format($row['avg_defense'], 2)  ?></td>
                                    </tr>
                                <?php endwhile ?>
                            <?php else : ?>
                                <tr>
                                    <td>No data Found</td>
                                    <td></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <aside class="border p-3 w-auto rounded">
        <h2>Register Sprigatito in the pokedex!</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="d-flex align-items-center">
                <div><img src="img/sprigatito.gif" alt=""></div>
                <div class="d-flex flex-column gap-1">
                    <input type="submit" value="Catch Sprigatito!" id="add" name="add" class="btn btn-success d-block">
                    <input type="submit" value="See Sprigatito's Data" id="see" name="see" class="btn btn-warning d-block">
                    <input type="submit" value="EV train Sprigatito" id="update" name="update" class="btn btn-info d-block">
                    <input type="submit" value="Delete Sprigatito's Data" id="delete" name="delete" class="btn btn-danger d-block">

                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['add'])) {
            $sql = "SELECT * FROM `pokedex` WHERE name = 'Sprigatito'";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) === 0) {
                $sql = "INSERT INTO pokedex (name, type_1, type_2, hp, attack, defense, speed, special_attack, special_defense, generation, legendary) VALUES
                ('Sprigatito', 'Grass', NULL, 40, 61, 54, 65, 45, 45, 9, false)";
                $result = mysqli_query($connection, $sql);

                if ($result === true) {
                    echo "<p>Sprigatito was caught.</p>";
                    echo "<p>Sprigatito is succesfully registered in the pokedex.</p>";
                }
            } else {
                echo "<p>Sprigatito was caught.</p>";
                echo "<p>Sprigatito is already registered in the pokedex.</p>";
            }
        }
        ?>

        <?php if (isset($_POST['see'])) : ?>
            <?php
            $sql = "SELECT * FROM `pokedex` WHERE name = 'Sprigatito'";
            $result = mysqli_query($connection, $sql);
            ?>
            <table class="table w-auto">
                <thead>
                    <th class="h4">Sprigatito</th>
                    <th></th>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($result) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <th>Primary Type</th>
                                <td><?php echo $row['type_1'] ?></td>
                            </tr>
                            <tr>
                                <th>Secondary Type</th>
                                <td><?php echo $type_2 = isset($row['type_2']) ? $row['type_2']  : "None"; ?></td>
                            </tr>
                            <tr>
                                <th>HP</th>
                                <td><?php echo $row['hp'] ?></td>
                            </tr>
                            <tr>
                                <th>Attack</th>
                                <td><?php echo $row['attack'] ?></td>
                            </tr>
                            <tr>
                                <th>Defense</th>
                                <td><?php echo $row['defense'] ?></td>
                            </tr>
                            <tr>
                                <th>Speed</th>
                                <td><?php echo $row['speed'] ?></td>
                            </tr>
                            <tr>
                                <th>Special Attack</th>
                                <td><?php echo $row['special_attack'] ?></td>
                            </tr>
                            <tr>
                                <th>Special Defense</th>
                                <td><?php echo $row['special_defense'] ?></td>
                            </tr>
                            <tr>
                                <th>Generation</th>
                                <td><?php echo $row['generation'] ?></td>
                            </tr>
                            <tr>
                                <th>Legendary?</th>
                                <td><?php echo $legendary = ($row['legendary'] === false) ? "yeah!" : "naur..."; ?></td>
                            </tr>

                        <?php endwhile ?>
                    <?php else : ?>
                        <tr>
                            <td>No data Found. Sprigatito is not registered in the pokedex. Please catch one!</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        <?php endif; ?>

        <?php
        if (isset($_POST['update'])) {
            $sql = "SELECT * FROM `pokedex` WHERE name = 'Sprigatito'";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) === 1) {
                $sql = "UPDATE pokedex SET speed = speed + 10 WHERE name = 'Sprigatito'";
                $result = mysqli_query($connection, $sql);

                if ($result === true) {
                    $sql = "SELECT speed FROM `pokedex` WHERE name = 'Sprigatito'";
                    $result = mysqli_query($connection, $sql);
                    $row = mysqli_fetch_assoc($result);

                    echo  "<p>Sprigatito's Speed is raised by 10. Its at " . $row['speed'] . "!</p>";
                }
            } else {
                echo "<p>Can't EV train Sprigatito. Please catch one!</p>";
            }
        }
        ?>

        <?php
        if (isset($_POST['delete'])) {
            $sql = "SELECT * FROM `pokedex` WHERE name = 'Sprigatito'";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) === 1) {
                $sql = "DELETE FROM pokedex WHERE name = 'Sprigatito'";
                $result = mysqli_query($connection, $sql);

                if ($result === true) {

                    echo  "<p>Sprigatito is deleted in the pokedex.</p>";
                }
            } else {
                echo "<p>Sprigatito is already deleted in the pokedex</p>";
            }
        }
        ?>
    </aside>
</main>

<?php
include('includes/footer.php');
?>