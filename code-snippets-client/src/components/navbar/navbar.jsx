import React from 'react';
import { Link } from 'react-router-dom';
import logo from "../../assets/images/logo2.png";
import "./navbar.css";

function Navbar() {
    return (
        <div className="navbar">
            <div className="logo-section">
                <Link to="/home">
                    <img src={logo} alt="Askify Logo" />
                </Link>
            </div>
            <div className="nav-links">
                <Link to="/about-us">About Us</Link>
                <Link to="/logout">Logout</Link>
            </div>
        </div>
    );
}

export default Navbar;
