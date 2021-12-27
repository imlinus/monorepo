import html from '@imlinus/component'

function AppCard ({ value, index }) {
  return () => html`
    <div class="card app-${index}">
      ${value}
    </div>
  `
}

function CurrentApp (value) {
  return () => html`
    <div class="card current-app">
      ${value}
    </div>
  `
}

function AppsList (apps, current) {
  return () => html`
    <div class="apps">
      <div class="list">
        ${apps.map((value, index) =>
          AppCard({ value, index })
        )}
      </div>

      ${CurrentApp(current)}
    </div>
  `
}

export default function App () {
  return state => html`
    <div id="root">
      <h1 class="title">Authenticator</h1>
      ${AppsList(state.apps, state.value)}
    </div>
  `
}
