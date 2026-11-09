<?php
require "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student = [
        "name"     => trim($_POST["name"] ?? ""),
        "course"   => trim($_POST["course"] ?? ""),
        "quiz"     => $_POST["quiz"] ?? "",
        "activity" => $_POST["activity"] ?? "",
        "exam"     => $_POST["exam"] ?? ""
    ];

    if ($student["name"] === "") {
        $message = "Student name is required.";
    } elseif ($student["course"] === "") {
        $message = "Course code is required.";
    } elseif (!is_numeric($student["quiz"])) {
        $message = "Quiz score must be numeric.";
    } elseif (!is_numeric($student["activity"])) {
        $message = "Activity score must be numeric.";
    } elseif (!is_numeric($student["exam"])) {
        $message = "Examination score must be numeric.";
    } elseif ($student["quiz"] < 0 || $student["quiz"] > 100) {
        $message = "Quiz score must be from 0 to 100.";
    } elseif ($student["activity"] < 0 || $student["activity"] > 100) {
        $message = "Activity score must be from 0 to 100.";
    } elseif ($student["exam"] < 0 || $student["exam"] > 100) {
        $message = "Examination score must be from 0 to 100.";
    } else {
        $average = computeAverage($student["quiz"], $student["activity"], $student["exam"]);
        $remark  = getRemark($average);
        $status  = $average >= 75 ? "PASSED" : "FAILED";

        $safeName   = htmlspecialchars($student["name"], ENT_QUOTES, "UTF-8");
        $safeCourse = htmlspecialchars($student["course"], ENT_QUOTES, "UTF-8");

        $message = $safeName . " (" . $safeCourse . ")<br>"
                 . "Average: " . number_format($average, 2) . "<br>"
                 . "Remark: <strong>" . $remark . "</strong><br>";
                //  . "Result: <strong>" . $status . "</strong>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grade Evaluator</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <style>
        body {
            background-color: #dae9ff;
            min-height: 100vh;
        }
        .evaluator-card {
            max-width: 640px;
            margin: 0 auto;
            border: 0;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }
        .evaluator-card .card-header {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: 1.25rem 1.5rem;
        }
        .section-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="card evaluator-card">
        <div class="card-header">
            <h1 class="h4 mb-1 text-center">Student Grade Evaluator</h1>
            <p class="text-center">Enter the student's details and scores to compute the average.</p>
        </div>

        <div class="card-body p-4">
            <form method="post">
                <p class="section-label mb-2">Student Information</p>
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <label for="name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               required>
                    </div>
                    <div class="col-md-4">
                        <label for="course" class="form-label">Course Code</label>
                        <input type="text" class="form-control" id="course" name="course"
                               required>
                    </div>
                </div>

                <p class="section-label mb-2">Scores (0 to 100)</p>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="quiz" class="form-label">Quiz</label>
                        <input type="number" class="form-control" id="quiz" name="quiz"
                               min="0" max="100" required>
                    </div>
                    <div class="col-md-4">
                        <label for="activity" class="form-label">Activity</label>
                        <input type="number" class="form-control" id="activity" name="activity"
                               min="0" max="100" required>
                    </div>
                    <div class="col-md-4">
                        <label for="exam" class="form-label">Examination</label>
                        <input type="number" class="form-control" id="exam" name="exam"
                               min="0" max="100" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Evaluate</button>
                </div>
            </form>

            <?php if ($message !== ""): ?>
                <div class="alert alert-info mt-4 mb-0" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>