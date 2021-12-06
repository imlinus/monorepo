## Color
I needed some colors in my logs

#### Use
```js
import color from '@imlinus/color'

console.log(color.blue('Hello, World.'))

// Methods
color.inverse('inverse')
color.white('white')
color.grey('grey')
color.blue('blue')
color.cyan('cyan')
color.green('green')
color.magenta('magenta')
color.red('red')
color.yellow('yellow')

color.success('Success!')
color.warning('Warning!')
color.error('Error!')
```


# Is Port Busy
Checks if port is available, otherwise suggests nearby

Commonly used with [HTTP Server](tools?id=http-server)

```js
import Server from '@imlinus/http-server'
import isPortBusy from '@imlinus/isPortBusy'

(async () => {
  const availablePort = await isPortBusy(1337)

  new Server({
    src: '/dist',
    port: availablePort,
    main: 'index.html'
  })
})
```


# Mock Data

```js
import mock from '@imlinus/mock-data'

const random = mock.random()

console.log(random)

// Will generate:
// {
//   gender: 'male',
//   name: 'Christian',
//   lastName: 'Brown',
//   email: 'christian_brown@yahoo.com',
//   password: 'T@Ny5zjsTU'
// }
```

### API
```js
const gender = mock.gender()
const name = mock.name(gender)
const lastName = mock.lastName()
const email = mock.email(firstName, lastName)
const password = mock.password()

// or if you want em' all
const random = mock.random()
```
