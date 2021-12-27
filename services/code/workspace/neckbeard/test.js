import React from 'react'
import ReactDOM from 'react-dom'
import './index.css'
import App from './App'

// Import ThirdWebtttsttttsttttttttt
import { ThirdwebWeb3Provider } from '@3rdweb/hooks';

// Include what chains you wanna support.
// 4 = Rinkeby.
const supportedChainIds = [250];


// Include what type of wallet you want to support.
// In this case, we support Metamask which is an "injected wallet".
const connectors = {
  injected: {},
};

// Finally, wrap App with ThirdwebWeb3Provider.
ReactDOM.render(
  <React.StrictMode>
    <div className="landing">
      <App />
    </div>
  </React.StrictMode>,
  document.getElementById('root')
);
