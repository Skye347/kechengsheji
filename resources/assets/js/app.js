import React, { Component } from 'react';
import { render } from 'react-dom';
import AppBar from 'material-ui/lib/app-bar';
import RaisedButton from 'material-ui/lib/raised-button';
import 'whatwg-fetch';

class Test extends Component{
    constructor(){
        super();
    };
    clicktest(){
        fetch('http://192.168.31.186/api/basic/show?token='+document.cookie.split(";")[0].split("=")[1]).then(function(response){
            return response.text();
        }).then(function(body){
            document.getElementById('content').innerText=body;
        });
    };
    render(){
        return(
            <div>
                <RaisedButton label="test click" onClick={this.clicktest} />
            </div>
        );
    }
}

render(
    <AppBar title="Home" style={{boxShadow:""}}/>,
    document.getElementById('test')
);

render(
    <Test title="Home" style={{boxShadow:""}}/>,
    document.getElementById('button')
);
