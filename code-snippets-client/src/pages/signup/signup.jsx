import React, { useState} from "react"; 
import { useNavigate, Link} from 'react-router-dom';  
import "./signup.css";
import api from '../../services/api';
import CodeSnippetsLogo from "../../assets/images/logo.png";

function Signup() {
  const [email, setEmail] = useState('');
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const onSignupSuccess = () => {
      navigate('/login');
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await api.post('api/v0.1/guest/signup', { email, username, password });
      if (response.data.success) {
        localStorage.setItem('token', response.data.data.token);
        localStorage.setItem('id', response.data.data.id);
        onSignupSuccess();
      } else {
        setError(response.data.error);
      }
    } catch (err) {
      console.error(err);
      setError('An error occurred. Please try again.');
    }
  };

  return (
    <div className="signup-form">
      <form className="signup-box" onSubmit={handleSubmit}>
        <div className="container1">
          <div className="signup-logo">
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
            <label htmlFor="username">Username*</label>
            <input
              type="text"
              placeholder="JhonDoe"
              id="username"
              name="username"
              value={username}
              onChange={(e) => setUsername(e.target.value)}
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
          

          <div className="signup-btn">
            <button type="submit">Signup</button>
          </div>

          <div className="apply">
          {error && <p className="error">{error}</p>}
            <p>Already have an account?</p>
            <Link to="/login" className="login-link">Click Here</Link>
          </div>

        </div>
      </form>
    </div>
  );
}

export default Signup;
