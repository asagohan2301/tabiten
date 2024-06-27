import type { City } from '@/types/APIDataTypes'

export default function CityComponent({ city }: { city: City }) {
  return <a href={`/cities/${city.id}/weather`}>{city.city_name}</a>
}
