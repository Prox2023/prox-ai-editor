import './scss/main.scss';

import React from 'react';
import ReactDOM from 'react-dom';
import Main from './Main'; // Adjust the path according to your file structure

ReactDOM.render(
    <React.StrictMode>
        <Main />
    </React.StrictMode>,
    document.getElementById('prox-ai-editor-app')
);