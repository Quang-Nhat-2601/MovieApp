import '../../style/index.css';

import React, { useEffect } from 'react';
import { connect } from 'react-redux';
import { Routes, Route, BrowserRouter } from 'react-router-dom';
import Nav from './Nav';
import SignInPage from './SignInPage';
import SignUpPage from './SignUpPage';
import SingleMoviePage from './SingleMoviePage';
import LandingPage from './LandingPage';
import MoviesPage from './MoviesPage';
import { login } from '../redux/action/loginAction';
import ActorsPage from './ActorsPage';
import ResetPasswordPage from './ResetPassworPage';
import HomePage from "./HomePage"

function App(props) {
    useEffect(() => {
        if (localStorage.getItem('access')) {
            props.login();
        }
    }, []);

    return (
        <BrowserRouter>
            <Nav />
            <Routes>
                {/* --------- Add Page here ----------- */}

                <Route path='/home' element={< LandingPage />} ></Route>

                <Route path='/' element={<HomePage />} ></Route>

                <Route path='/signin' element={<SignInPage />}></Route>
                <Route path='/signup' element={<SignUpPage />}></Route>
                <Route path='/movies' element={<MoviesPage />}></Route>
                <Route path='/movies/:id' element={<SingleMoviePage />}></Route>
                <Route path='/actors' element={<ActorsPage />}></Route>

                <Route path="/reset" element={<ResetPasswordPage />}></Route>
            </Routes>

        </BrowserRouter >
    );
}

const mapDispatchToProps = {
    login
}

export default connect(null, mapDispatchToProps)(App);