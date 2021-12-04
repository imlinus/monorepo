import { render, log } from '@imlinus/component'
import App from './app.js'

let data = {
  apps: [
    'Binance',
    'Coinbase',
    'Bitwarden'
  ],
  value: ''
}

function stateManager (state = data, action, args) {
  switch (action) {
    case 'CHANGE_VALUE': {
      let [value] = args

      return {
        ...state,
        value
      }
    }

    case 'ADD_APP': {
      return {
        ...state,
        apps: state.apps.concat(state.value),
        value: ''
      }
    }

    default:
      return state
  }
}

window.dispatch = render(App(), log(stateManager))
