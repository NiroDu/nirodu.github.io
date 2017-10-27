// //main.js 
// const greeter = require('./Greeter.js');
// document.querySelector("#root").appendChild(greeter());


// // main.js
// import React from 'react';
// import {render} from 'react-dom';
// import Greeter from './Greeter';

// render(<Greeter />, document.getElementById('root'));

//main.js
import React from 'react';
import {render} from 'react-dom';
import Greeter from './Greeter';

import './main.css';//使用require导入css文件
import './m.css';//使用require导入css文件
import './niro.scss';//使用require导入css文件

render(<Greeter />, document.getElementById('root'));