import Country from '@/components/CountryComponent'
import type { Area } from '@/types/APIDataTypes'

export default function AreaComponent({ area }: { area: Area }) {
  return (
    <div>
      <h2>{area.area_name}</h2>
      {area.countries.map((country) => (
        <Country key={country.id} country={country} />
      ))}
    </div>
  )
}
