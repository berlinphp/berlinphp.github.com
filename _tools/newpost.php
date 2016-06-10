#!/usr/bin/env php
<?php

$nextDate = new \DateTime();
$nextDate->setDate(date("Y"), date("n") + 1, 1);
try {
    if (isset($argv[1])) {
        $nextDate = new \DateTime($argv[1] . "-01");
    }
} catch (\Exception $e) {
    echo "Invliade date 'YYYY-MM'\n";
    exit();
}

if ($nextDate->format("w") != 2) {
    $nextDate->modify("next tuesday");
}

$lines = [];
$lines[] = "---\n";
$lines[] = "layout: post-slots\n";
$lines[] = "title: Meetup on the " . $nextDate->format('jS \o\f F, Y') . "\n";
$lines[] = "datetitle: " . $nextDate->format('F jS, Y') . "\n";
$lines[] = "published: false\n";
$lines[] = "meetupdate: " . $nextDate->format('Y-m-d') . "\n";
$lines[] = "---\n";

$postsFolder = __DIR__ . "/../_posts";

$template = file($postsFolder . "/_template.html");

$newFile = $lines + $template;
$newFileName = $nextDate->format("Y-m-d-") . strtolower($nextDate->format("F")) . ".html";

if (file_exists($postsFolder . "/" . $newFileName)) {
    echo "File " . $newFileName . " already exists\n";
    exit();
}

file_put_contents($postsFolder . "/" . $newFileName, $newFile);
echo "Done writing " . $newFileName . "\n";
