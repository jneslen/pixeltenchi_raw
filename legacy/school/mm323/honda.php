<?php
    /* Connecting, selecting database */
    $link = mysql_connect("xzbtr.com", "xzbtr_xzbtr", "stationx123")
        or die("Could not connect : " . mysql_error());
    print "Connected successfully";
    mysql_select_db("xzbtr_dbmm323") or die("Could not select database");

    /* Performing SQL query */
    $query = "SELECT * FROM `japcars`";
    $result = mysql_query($query) or die("Query failed : " . mysql_error());
    /* Printing results in HTML */
    print "<table border=1>\n";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	
        print "\t<tr>\n";
        foreach ($line as $col_value) {
            print "\t\t<td>$col_value</td>\n";
        }
        print "\t</tr>\n";
    }
    print "</table>\n";

    /* Free resultset */
    mysql_free_result($result);

    /* Closing connection */
    mysql_close($link);
?>