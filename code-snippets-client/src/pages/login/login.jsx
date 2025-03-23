import React, { useState} from "react"; 
import { useNavigate, Link} from 'react-router-dom';  
import "./login.css";
import api from '../../services/api';
import CodeSnippetsLogo from "../../assets/images/logo.png";

function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const onLoginSuccess = () => {
      navigate('/allsnippets');
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await api.post('api/v0.1/guest/login', { email, password });
      if (response.data.success) {
        localStorage.setItem('token', response.data.data.token);
        localStorage.setItem('id', response.data.data.id);
        onLoginSuccess();
      } else {
        setError(response.data.error);
      }
    } catch (err) {
      console.error(err);
      setError('An error occurred. Please try again.');
    }
  };

  return (
    <div className="login-form">
      <form className="login-box" onSubmit={handleSubmit}>
        <div className="container1">
          <div className="login-logo">
          <img src={CodeSnippetsLogo} alt="Code Dnippets Logo" className="logo" />
          </div>

          <h2>Welcome to CodeBits!</h2>

          <div className="form-field">
            <label htmlFor="email">Email*</label>
            <input
              type="text"
              placeholder="jhondoe@gmail.com"
              id="email"
              name="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>

          <div className="form-field">
            <label htmlFor="password">Password*</label>
            <input
              type="password"
              placeholder="*****"
              id="password"
              name="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>

          <div className="login-btn">
            <button type="submit">Login</button>
          </div>

          <div className="apply">
          {error && <p className="error">{error}</p>}
            <p>Already have an account?</p>
            <Link to="/signup" className="signup-link">Click Here</Link>
          </div>

        </div>
      </form>
    </div>
  );
}

export default Login;
