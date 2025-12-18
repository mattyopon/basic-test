// タスク管理機能
const taskInput = document.getElementById('taskInput');
const addButton = document.getElementById('addButton');
const taskList = document.getElementById('taskList');

// ローカルストレージからタスクを読み込む
let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

// タスクを表示する関数
function renderTasks() {
    taskList.innerHTML = '';
    tasks.forEach((task, index) => {
        const li = document.createElement('li');
        li.className = `task-item ${task.completed ? 'completed' : ''}`;
        li.innerHTML = `
            <span onclick="toggleTask(${index})" style="cursor: pointer; flex: 1;">
                ${task.text}
            </span>
            <button onclick="deleteTask(${index})">削除</button>
        `;
        taskList.appendChild(li);
    });
    // ローカルストレージに保存
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// タスクを追加する関数
function addTask() {
    const taskText = taskInput.value.trim();
    if (taskText === '') {
        alert('タスクを入力してください');
        return;
    }
    tasks.push({ text: taskText, completed: false });
    taskInput.value = '';
    renderTasks();
}

// タスクを削除する関数
function deleteTask(index) {
    if (confirm('このタスクを削除しますか？')) {
        tasks.splice(index, 1);
        renderTasks();
    }
}

// タスクの完了状態を切り替える関数
function toggleTask(index) {
    tasks[index].completed = !tasks[index].completed;
    renderTasks();
}

// イベントリスナー
addButton.addEventListener('click', addTask);
taskInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        addTask();
    }
});

// カウンター機能
const counterValue = document.getElementById('counterValue');
const incrementButton = document.getElementById('incrementButton');
const decrementButton = document.getElementById('decrementButton');
const resetButton = document.getElementById('resetButton');

// ローカルストレージからカウンター値を読み込む
let counter = parseInt(localStorage.getItem('counter')) || 0;
counterValue.textContent = counter;

// カウンターを増やす
incrementButton.addEventListener('click', () => {
    counter++;
    updateCounter();
});

// カウンターを減らす
decrementButton.addEventListener('click', () => {
    counter--;
    updateCounter();
});

// カウンターをリセット
resetButton.addEventListener('click', () => {
    if (confirm('カウンターをリセットしますか？')) {
        counter = 0;
        updateCounter();
    }
});

// カウンターを更新する関数
function updateCounter() {
    counterValue.textContent = counter;
    localStorage.setItem('counter', counter.toString());
}

// 初期表示
renderTasks();

