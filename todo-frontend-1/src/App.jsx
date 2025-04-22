// src/App.js
import React, { useState } from "react";
import { BrowserRouter as Router, Routes, Route, Navigate } from "react-router-dom";
import AuthForm from "./AuthForm";
import TodoApp from "./TodoApp";

const App = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  const handleAuth = () => setIsLoggedIn(true);
  const handleLogout = () => setIsLoggedIn(false);

  return (
    <Router>
      <Routes>
        <Route
          path="/"
          element={
            isLoggedIn ? <Navigate to="/todoapp" replace /> : <AuthForm onAuth={handleAuth} />
          }
        />
        <Route
          path="/todoapp"
          element={
            isLoggedIn ? (
              <div className="row">
                 <div className="col-md-4">
                    <div className="bg-danger text-white p-4" style={{ width: '350px', height: '100vh' }}>
                    <h2 className="fw-bold">Todo-Pascale</h2>
                    <ul className="nav flex-column mt-4">
                        <li className="nav-item mb-2"><i className="bi bi-house"></i> Home</li>
                        <li className="nav-item mb-2"><i className="bi bi-clipboard-check"></i> Todos</li>
                        <li className="nav-item"><i className="bi bi-gear"></i> Settings</li>
                    </ul>
                    </div>
                </div>
                <div className="col-md-6 bg-light" style={{ width: '700px' }}>
                  <div className="d-flex justify-content-between align-items-center mb-4">
                    <h3 className="text-danger">Menu Todo-Pascale</h3>
                    <button onClick={handleLogout} className="btn btn-danger">Se déconnecter</button>
                  </div>
                  <TodoApp />
                </div>
              </div>
            ) : (
              <Navigate to="/" />
            )
          }
        />
        {/* Fallback route */}
        <Route path="*" element={<Navigate to="/" />} />
      </Routes>
    </Router>
  );
};

export default App;
