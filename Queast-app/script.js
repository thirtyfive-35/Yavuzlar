const questions = [];
let currentQuestionIndex = 0;
let score = 0;

document.getElementById('addQuestionForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const question = document.getElementById('question').value;
    const answers = [
        document.getElementById('answer1').value,
        document.getElementById('answer2').value,
        document.getElementById('answer3').value,
        document.getElementById('answer4').value
    ];
    const correctAnswer = parseInt(document.getElementById('correctAnswer').value);
    const difficulty = document.getElementById('difficulty').value;

    questions.push({ question, answers, correctAnswer, difficulty });
    displayQuestions(questions);
    this.reset();
});

function displayQuestions(questionsToDisplay) {
    const questionsList = document.getElementById('questionsList');
    questionsList.innerHTML = '';

    questionsToDisplay.forEach((q, index) => {
        const questionDiv = document.createElement('div');
        questionDiv.classList.add('question-container');
        questionDiv.innerHTML = `
            <div><strong>${q.question}</strong> (${q.difficulty})</div>
            <div>${q.answers.map((answer, i) => `<div>${i + 1}. ${answer}</div>`).join('')}</div>
            <button onclick="editQuestion(${index})">Düzenle</button>
            <button onclick="deleteQuestion(${index})">Sil</button>
        `;
        questionsList.appendChild(questionDiv);
    });
}

function deleteQuestion(index) {
    questions.splice(index, 1);
    displayQuestions(questions);
}

function editQuestion(index) {
    const q = questions[index];
    document.getElementById('question').value = q.question;
    document.getElementById('answer1').value = q.answers[0];
    document.getElementById('answer2').value = q.answers[1];
    document.getElementById('answer3').value = q.answers[2];
    document.getElementById('answer4').value = q.answers[3];
    document.getElementById('correctAnswer').value = q.correctAnswer;
    document.getElementById('difficulty').value = q.difficulty;
    deleteQuestion(index);
}

function searchQuestion() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const filteredQuestions = questions.filter(q => q.question.toLowerCase().includes(searchTerm));
    displayQuestions(filteredQuestions);
}

function startQuiz() {
    document.getElementById('questionManagement').classList.remove('active');
    document.getElementById('questionManagement').classList.add('hidden');
    document.getElementById('quizScreen').classList.remove('hidden');
    document.getElementById('quizScreen').classList.add('active');
    currentQuestionIndex = 0;
    score = 0;
    showNextQuestion();
}

function showNextQuestion() {
    const quizContainer = document.getElementById('quiz');
    quizContainer.innerHTML = '';

    if (currentQuestionIndex < questions.length) {
        const q = questions[currentQuestionIndex];
        const questionDiv = document.createElement('div');
        questionDiv.innerHTML = `
            <div><strong>${q.question}</strong></div>
            ${q.answers.map((answer, i) => `
                <div>
                    <input type="radio" name="question${currentQuestionIndex}" value="${i + 1}" id="question${currentQuestionIndex}${i}" />
                    <label for="question${currentQuestionIndex}${i}">${answer}</label>
                </div>
            `).join('')}
        `;
        quizContainer.appendChild(questionDiv);
    } else {
        document.querySelector('.score').textContent = `Quiz Tamamlandı! Toplam Puanınız: ${score}`;
        document.getElementById('nextQuestion').style.display = 'none';
    }
}

function checkAnswer() {
    const q = questions[currentQuestionIndex];
    const selectedAnswer = document.querySelector(`input[name="question${currentQuestionIndex}"]:checked`);

    if (selectedAnswer) {
        const selectedValue = parseInt(selectedAnswer.value);
        
        if (selectedValue === q.correctAnswer) {
            score++;
        }
        
        currentQuestionIndex++;
        showNextQuestion();
    } else {
        alert('Lütfen bir cevap seçin.');
    }
}

document.getElementById('nextQuestion').addEventListener('click', function() {
    checkAnswer();
});
