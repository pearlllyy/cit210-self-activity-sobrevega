# Student Grade Evaluator

A simple PHP web app that computes a student's average from their quiz, activity, and examination scores, then shows if they passed or failed.

## Files

- `index.php` - form, validation, and result
- `functions.php` - `computeAverage()` and `getRemark()`
- `assets/bootstrap.min.css` - Bootstrap styles

## Project Structure
 
```
student-grade-evaluator/
├── index.php          # Form, validation, and result display
├── functions.php      # computeAverage() and getRemark()
├── README.md
└── assets/
    └── bootstrap.min.css
```
 
## How to Run

1. Put the project folder in `htdocs` (XAMPP) and start Apache.
2. Open `http://localhost/student-grade-evaluator/` in your browser.

## How to Use

1. Enter the student's name, course code, and scores (0 to 100).
2. Click **Evaluate**.
3. The average, remark, and PASSED or FAILED result appear below the form.

A student passes with an average of 75 or higher.