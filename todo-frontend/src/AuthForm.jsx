// AuthForm.js
import React, { useState } from 'react';

import axios from 'axios';

import { useNavigate } from "react-router-dom";

export default function AuthForm({ onAuth }) {
  const [isLogin, setIsLogin] = useState(true);
  const [formData, setFormData] = useState({
    firstName: '',
    lastName: '',
    phone: '',
    email: '',
    password: '',
  });

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const toggleForm = () => {
    setIsLogin(!isLogin);
    setFormData({
      firstName: '',
      lastName: '',
      phone: '',
      email: '',
      password: '',
    });
  };

  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();

    const apiUrl =  window.env?.API_URL ?? 'http://127.0.0.1:8000/api';

    try {
      if (isLogin) {
        // Connexion
        const response = await axios.post(`${apiUrl}/login`, {
          email: formData.email,
          password: formData.password,
        });

        const { token, user } = response.data;
        localStorage.setItem('token', token);
        onAuth();
        navigate("/todoapp");
        alert(`Bienvenue ${user.firstName} !`);

      } else {
        await axios.post(`${apiUrl}/register`, {
            firstName: formData.firstName,
            lastName: formData.lastName,
            phoneNumber: formData.phone,
            email: formData.email,
            password: formData.password,
          });


        alert('Inscription réussie ! Vous pouvez maintenant vous connecter.');
        setIsLogin(true); // bascule vers le formulaire de connexion
      }
    } catch (error) {
      if (error.response) {
        alert(`Erreur : ${error.response.data.message || JSON.stringify(error.response.data)}`);
      } else {
        alert("Une erreur est survenue. Vérifiez votre connexion.");
      }
    }
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100">
      <div className="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 className="text-2xl font-bold text-center mb-6">
          {isLogin ? 'Connexion' : 'Inscription'}
        </h2>

        <form onSubmit={handleSubmit} className="space-y-4">
          {!isLogin && (
            <>
              <input
                type="text"
                name="firstName"
                placeholder="Prénom"
                value={formData.firstName}
                onChange={handleChange}
                className="w-full px-4 py-2 border rounded"
              />
              <input
                type="text"
                name="lastName"
                placeholder="Nom"
                value={formData.lastName}
                onChange={handleChange}
                className="w-full px-4 py-2 border rounded"
              />
              <input
                type="text"
                name="phone"
                placeholder="Numéro de téléphone"
                value={formData.phone}
                onChange={handleChange}
                className="w-full px-4 py-2 border rounded"
              />
            </>
          )}

          <input
            type="email"
            name="email"
            placeholder="Email"
            value={formData.email}
            onChange={handleChange}
            className="w-full px-4 py-2 border rounded"
            required
          />
          <input
            type="password"
            name="password"
            placeholder="Mot de passe"
            value={formData.password}
            onChange={handleChange}
            className="w-full px-4 py-2 border rounded"
            required
          />

          <button
            type="submit"
            className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
          >
            {isLogin ? 'Se connecter' : "S'inscrire"}
          </button>
        </form>

        <p className="text-center mt-4">
          {isLogin ? (
            <>
              Vous n'avez pas de compte ?{' '}
              <button
                type="button"
                onClick={toggleForm}
                className="text-blue-600 underline"
              >
                S'inscrire
              </button>
            </>
          ) : (
            <>
              Vous avez déjà un compte ?{' '}
              <button
                type="button"
                onClick={toggleForm}
                className="text-blue-600 underline"
              >
                Se connecter
              </button>
            </>
          )}
        </p>
      </div>
    </div>
  );
}
