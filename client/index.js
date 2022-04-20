import { post } from "./WebRequest";

const answerKey = ["c", "b", "a", "false", "true", "sacramento"];

function handleSubmit(e) {
  let form = document.querySelector("form");
  let isValid = form.checkValidity();
  if (!isValid) {
    form.reportValidity();
  } else {
    e.preventDefault();

    let radioBtns = [...document.querySelectorAll('input[type="radio"]')];
    let givenAnswer = document.querySelector('input[name="q6"]');

    radioBtns = radioBtns.filter((value) => value.checked);

    let answers = [...radioBtns, givenAnswer];

    answers.forEach((value, index, array) => {
      array[index] = value.value.toLowerCase();
    });

    gradeQuiz(answers, answerKey);
  }
}

function gradeQuiz(answers, key) {
  const results = document.querySelector("div");
  let score = 0;
  for (let i = 0; i < key.length; i++) {
    if (answers[i] === key[i]) {
      score++;
    }
  }
  results.innerHTML = "<h3>You scored " + score + " out of " + key.length + ".";

  saveQuiz(score);
}

async function saveQuiz(score) {
  let user = document.querySelector('input[name="user"]').value;

  let result = await post(
    "../server/submission.php",
    JSON.stringify({ user: user, score: score })
  );
  console.log(result);
}

const submitBtn = document.querySelector('input[type="submit"]');
submitBtn.addEventListener("click", handleSubmit);
