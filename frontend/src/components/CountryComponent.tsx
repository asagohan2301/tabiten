import City from '@/components/CityComponent'
import type { Country } from '@/types/APIDataTypes'

export default function CountryComponent({ country }: { country: Country }) {
  return (
    <div>
      <p>{country.country_name}</p>
      <div>
        {country.cities.map((city) => (
          <City key={city.id} city={city} />
        ))}
      </div>
    </div>
  )
}
