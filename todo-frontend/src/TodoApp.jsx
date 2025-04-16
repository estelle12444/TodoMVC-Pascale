// src/TodoApp.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';

const TodoApp = () => {
  const [todos, setTodos] = useState([]);
  const [newTask, setNewTask] = useState('');

  useEffect(() => {
    const token = localStorage.getItem("token");

    axios.get("http://localhost:8000/api/todos", {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    })
      .then((res) => setTodos(res.data))
      .catch((err) => console.error("Erreur lors de la récupération des todos :", err));
  }, []);


  const addTodo = (e) => {
    e.preventDefault();
    if (!newTask.trim()) return;

    axios.post('http://localhost:8000/api/todos', { name: newTask })
      .then(res => {
        setTodos([...todos, res.data]);
        setNewTask('');
      })
      .catch(err => console.error(err));
  };

  const deleteTodo = (id) => {
    axios.delete(`http://localhost:8000/api/todos/${id}`)
      .then(() => setTodos(todos.filter(t => t.id !== id)))
      .catch(err => console.error(err));
  };

  const toggleTodo = (id) => {
    const todo = todos.find(t => t.id === id);
    axios.put(`http://localhost:8000/api/todos/${id}`, { completed: !todo.completed })
      .then(() => {
        setTodos(todos.map(t => (t.id === id ? { ...t, completed: !t.completed } : t)));
      });
  };

  return (
    <>
      <form onSubmit={addTodo} className="d-flex mb-4">
        <input
          type="text"

          className="form-control me-2"
          placeholder="Add a new todo..."
          value={newTask}
          onChange={(e) => setNewTask(e.target.value)}
        />
        <button type="submit" className="btn btn-success">+</button>
      </form>

      <ul className="list-unstyled">
        {todos.map(todo => (
          <li
            key={todo.id}
            className={`d-flex align-items-center justify-content-between p-3 rounded mb-2 ${
              todo.completed ? 'bg-success bg-opacity-25' : 'bg-white border'
            }`}
          >
            <div className="form-check">
              <input
                className="form-check-input"
                type="checkbox"
                checked={todo.completed}
                onChange={() => toggleTodo(todo.id)}
              />
              <label
                className={`form-check-label ms-2 ${
                  todo.completed ? 'text-decoration-line-through text-muted' : ''
                }`}
              >
                {todo.name}
              </label>
            </div>
            <div>
              <button className="btn btn-sm btn-outline-primary me-2">
                <i className="bi bi-pencil"></i>
              </button>
              <button className="btn btn-sm btn-outline-danger" onClick={() => deleteTodo(todo.id)}>
                <i className="bi bi-trash"></i>
              </button>
            </div>
          </li>
        ))}
      </ul>
    </>
  );
};

export default TodoApp;
