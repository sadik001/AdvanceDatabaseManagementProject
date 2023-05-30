<?php
            $conn = oci_connect('pritom', 'tree', '//localhost/XE');   
                    if (!$conn) {
                    echo 'Failed to connect to oracle' . "<br>";
                    }

                    $stid = oci_parse($conn, 'select * from flight where flight_cost=(select min(flight_cost) from flight)');
                    oci_execute($stid);
                    echo "<table border='1'>
                    <tr>
                        <th>FLIGHT_ID</th>
                        <th>DEPARTURE</th>
                        <th>DESTINATION</th>
                        <th>DEPARTURE_TIME</th>
                        <th>ARRIVAL_TIME</th>
                        <th>FLIGHT_COST</th>
                        <th>FLIGHT_CLASS</th>
                        
                    </tr>";

                while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                echo "<tr>";
                echo "<td>" . $row['FLIGHT_ID'] . "</td>";
                echo "<td>" . $row['DEPARTURE'] . "</td>";
                echo "<td>" . $row['DESTINATION'] . "</td>";
                echo "<td>" . $row['DEPARTURE_TIME'] . "</td>";
                echo "<td>" . $row['ARRIVAL_TIME'] . "</td>";
                echo "<td>" . $row['FLIGHT_COST'] . "</td>";
                echo "<td>" . $row['FLIGHT_CLASS'] . "</td>";
                echo "</tr>";
                }
                echo "</table>\n";

?>