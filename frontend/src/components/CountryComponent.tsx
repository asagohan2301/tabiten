import City from '@/components/CityComponent'
import type { Country } from '@/types/APIDataTypes'

export default function CountryComponent({ country }: { country: Country }) {
  return (
    <div className="mb-6 w-[22%]">
      <h3 className="mb-2 border-b-2 border-[#A3D5F6] text-[15px] font-semibold text-[#66BFF9]">
        {country.country_name}
      </h3>
      <div className="flex flex-wrap gap-x-4 gap-y-2">
        {country.cities.map((city) => (
          <City key={city.id} city={city} />
        ))}
      </div>
    </div>
  )
}
