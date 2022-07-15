import React from 'react';
import ReactDOM from 'react-dom';

function HelloReact() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">HelloReact Component</div>

                        <div className="card-body">I'm an HelloReact component!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default HelloReact;

if (document.getElementById('HelloReact')) {
    ReactDOM.render(<HelloReact />, document.getElementById('HelloReact'));
}
