let currentQuestion = 0;
let score = [];
let selectedAnswersData = [];
const container = document.querySelector('.quiz-container');
const questionEl = document.querySelector('.question');
const option1 = document.querySelector('.option1');
const option2 = document.querySelector('.option2');
const option3 = document.querySelector('.option3');
const nextButton = document.querySelector('.next');
const previousButton = document.querySelector('.previous');
const restartButton = document.querySelector('.restart');
const result = document.querySelector('.result');

// fetch the questions from the JSON file
fetch('questions.json')
  .then(response => response.json())
  .then(data => {
    const questions = data.questions;
    const totalQuestions = questions.length;

    // generate question
    function generateQuestions(index) {
      const question = questions[index];
      const option1Total = question.answer1Total;
      const option2Total = question.answer2Total;
      const option3Total = question.answer3Total;

      questionEl.innerHTML = `${index + 1}. ${question.question}`
      option1.setAttribute('data-total', `${option1Total}`);
      option2.setAttribute('data-total', `${option2Total}`);
      option3.setAttribute('data-total', `${option3Total}`);
      option1.innerHTML = `${question.answer1}`
      option2.innerHTML = `${question.answer2}`
      option3.innerHTML = `${question.answer3}`
    }
    // next question button
    function loadNextQuestion() {
      const selectedOption = document.querySelector('input[type="radio"]:checked');

      if (!selectedOption) {
        alert('Please select your answer!');
        return;
      }

      const answerScore = Number(selectedOption.nextElementSibling.getAttribute('data-total'));
      score.push(answerScore);

      const totalScore = score.reduce((total, currentNum) => total + currentNum);

      currentQuestion++;

      selectedOption.checked = false;

      // finish button (updates next to finish)
      if (currentQuestion == totalQuestions - 1) {
        nextButton.textContent = 'Finish';
      }
      // results upon test finish
      if (currentQuestion == totalQuestions) {
        container.style.display = 'none';
        result.innerHTML =
          `<h1 class="final-score">Your formula!</h1>
          <div class="summary">
            <h1>Summary</h1>
            <p>
After carefully analyzing your responses from the hair quiz, it's evident that you have a unique hair type and specific concerns that you'd like to address. Based on your answers, it seems that your hair type falls into the category of curly. Additionally, you've highlighted concerns such as frizz,volume.

For your hair type, it's essential to choose a shampoo that not only cleanses effectively but also caters to your specific needs. Furthermore, consider the frequency of your hair washes and how your scalp reacts to different products. If you tend to wash your hair frequently, opt for a gentle shampoo that won't strip away essential oils, especially if you have [dry/oily] hair. On the other hand, if you wash your hair less frequently, you might benefit from a clarifying shampoo to remove buildup and maintain scalp health.

In addition to choosing the right shampoo, incorporating a suitable conditioner or treatment can further enhance the health and appearance of your hair. Conditioners help to moisturize and detangle hair, making it more manageable and less prone to breakage. Look for conditioners that complement your chosen shampoo and address any additional concerns you may have, such as damage.

Remember that consistency is key when it comes to seeing results with hair care products. Give your new shampoo and conditioner regimen some time to work, and don't be afraid to adjust if you're not seeing the desired effects. Pay attention to how your hair responds to different products and adjust your routine accordingly.

Lastly, always follow the usage instructions provided with the products for the best results. Proper application and rinsing techniques can make a significant difference in how well a product works for your hair type and concerns.

By selecting the right shampoo and accompanying products tailored to your hair type and concerns, you can achieve healthier, more manageable hair that looks and feels its best.</p>
           
          <button class="restart">Restart Quiz</button>
          `;

        return;
      }

      generateQuestions(currentQuestion);
    }
    // previous question button
    function loadPreviousQuestion() {
      currentQuestion--;
      score.pop();
      generateQuestions(currentQuestion);
    }
    // restart after quiz is done
    function restartQuiz(e) {
      if (e.target.matches('button')) {
        currentQuestion = 0;
        score = [];
        location.reload();
      }
    }
    // event listeners
    generateQuestions(currentQuestion);
    nextButton.addEventListener('click', loadNextQuestion);
    previousButton.addEventListener('click', loadPreviousQuestion);
    result.addEventListener('click', restartQuiz);
  })
  .catch(error => console.error('Error fetching quiz data:', error));