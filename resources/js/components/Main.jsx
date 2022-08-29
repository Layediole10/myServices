import React from 'react';
import ReactDOM from 'react-dom';

function Main() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md">
                    <div className="card">
                        <div className="card-header">Nos services</div>

                        <div className="card-body">Déposez vos posts ici!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Main;

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}


