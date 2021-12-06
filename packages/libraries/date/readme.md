```javascript
import date from '@imlinus/date'


date(new Date(), 'DDD dd MMMM yyyy, hh:mm a')

date(new Date(), '"Today is" DDD "the" dd. "of" MMMM')

date(new Date(), 'DDD dd MMMM yyyy, HH:mm', {
  locale: 'sv-SE',
})

date(new Date(), 'DDD dd MMMM yyyy, hh:mm a', {
  timeZone: 'Europe/Stockholm',
})
```
