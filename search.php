<!DOCTYPE html>
<html>
<head>
    <title>Daily UW Search</title>
</head>

<body>

<h1>Daily UW: Student News Search</h1>

<p>
    This website contains data indexed from <a href="http://www.dailyuw.com">www.dailyuw.com</a>.<br>
    The website has news, opinions, and article pieces related to all UW students and their experiences.<br>
    Terms you could query: huskies, washington, quarter, Ave.
</p>

<form action="search.php" method="post">
    <input type="text" size="40" name="search_string" value="<?php echo $_POST['search_string'];?>" />
    <input type="submit" value="Search" />
</form>

<?php
if (isset($_POST['search_string'])) {
    $search_string = $_POST['search_string'];

    file_put_contents("logs.txt", $search_string . PHP_EOL, FILE_APPEND | LOCK_EX);

    $qfile = fopen("query.py", "w");

    fwrite($qfile, "import pyterrier as pt\nif not pt.started():\n\tpt.init()\n\n");
    fwrite($qfile, "import pandas as pd\nqueries = pd.DataFrame([[\"q1\", \"$search_string\"]], columns=[\"qid\",\"query\"])\n");
    fwrite($qfile, "index = pt.IndexFactory.of(\"./dailyuw_index/\")\n");
    fwrite($qfile, "bm25 = pt.BatchRetrieve(index, wmodel=\"BM25\")\n");
    fwrite($qfile, "results = bm25.transform(queries)\n");

    for ($i = 0; $i < 5; $i++) {
        fwrite($qfile, "print(index.getMetaIndex().getItem(\"filename\", results.docid[$i]))\n");
        fwrite($qfile, "if index.getMetaIndex().getItem(\"title\", results.docid[$i]).strip() != \"\":\n");
        fwrite($qfile, "\tprint(index.getMetaIndex().getItem(\"title\", results.docid[$i]))\n");
        fwrite($qfile, "else:\n\tprint(index.getMetaIndex().getItem(\"filename\", results.docid[$i]))\n");
    }

    fclose($qfile);

    exec("ls | nc -u 127.0.0.1 10031");
    sleep(3);

    $stream = fopen("output", "r");

    $line = fgets($stream);

    while (($line = fgets($stream)) != false) {
        $clean_line = preg_replace('/\s+/', ',', $line);
        $record = explode("./", $clean_line);
        $line = fgets($stream);
        echo "<a href=\"http://$record[1]\">" . $line . "</a><br/>\n";
    }

    fclose($stream);

    exec("rm query.py");
    exec("rm output");
}
?>

</body>
</html>
