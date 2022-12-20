<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magebit - Tests</title>
</head>
<body>
    <div class="main">
        <div class="backside">
			<div>
                <!-- [Uzrāda pilnu vārdu, uzvārdu izmantojot get_fullname funkciju] -->
                <h2>Sveicināts/-a, <?php $user->get_fullname($id); ?></h2>
                <img src="images/lineunder.png" alt="lineunder" width="43" height="5">
				<table id="users">
                    <tr>
                        <th>Nr.p.k.</th>
                        <th>Vārds, uzvārds</th>
                        <th>E-pasts</th>
                        <th>Parole</th>
                        <th>Vecums</th>
                        <th>Dzimums</th>
                        <th>Profesija</th>
                        <th>Hobiji</th>
                        <th>Opcijas</th>
                    </tr>
                    <!-- [Uzrāda visus lietotājus, kas atrodas datubāzē] -->
                    <?php
                        $rows = $user->fetch();
                        $i = 1;
                        if(!empty($rows)) {
                            foreach($rows as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['sex']; ?></td>
                        <td><?php echo $row['occupation']; ?></td>
                        <td><?php echo $row['hobbies']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Rediģēt</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Dzēst</a>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </table>
                <form action="index.php?op=logout">
                    <button type="submit">Logout</button>
                </form>
			</div>
        </div>
    </div>
</body>
</html>