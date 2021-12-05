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
const gender = mock.maleOrFemale()
const name = mock.name(gender)
const lastName = mock.lastName()
const email = mock.email(firstName, surName)
const password = mock.password()

// or if you want em' all
const random = mock.random()
```
