import { random } from './utils/random'
import { slug } from './utils/slug'
import { femaleNames, maleNames, lastNames, gender } from './data/names'
import { glues, emails } from './data/internet'
import { password } from './data/password'

const mock = {
  name (gender) {
    const type = gender === 'female' ? femaleNames : maleNames

    return random(type)
  },

  lastName () {
    return random(surNames)
  },

  gender () {
    return gender()
  },

  email (name, lastName) {
    const name = slug(name)
    const lastName = slug(lastName)
    const email = name + random(glues) + lastName + '@' + random(emails)

    return email
  },

  password (length = 10) {
    return password(length)
  },

  random () {
    const gender = mock.gender()
    const name = mock.name(gender)
    const lastName = mock.lastName()
    const email = mock.email(name, lastName)
    const password = mock.password()

    return {
      gender,
      name,
      lastName,
      email,
      password
    }
  }
}

export default mock
