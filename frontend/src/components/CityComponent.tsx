import type { City } from '@/types/APIDataTypes'

export default function CityComponent({ city }: { city: City }) {
  return (
    <a
      href={`/cities/${city.id}/weather`}
      className="transition hover:opacity-50"
    >
      {city.city_name}
    </a>
  )
}
