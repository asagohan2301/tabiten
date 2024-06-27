import Country from '@/components/CountryComponent'
import type { Area } from '@/types/APIDataTypes'

export default function AreaComponent({ area }: { area: Area }) {
  return (
    <div className="w-full rounded-lg border-4 border-[#A3D5F6] px-6 py-4">
      <h2 className="mb-6 w-fit rounded-full bg-[#66BFF9] px-4 py-2 text-center text-white">
        {area.area_name}
      </h2>
      <div className="flex flex-wrap gap-8 px-2">
        {area.countries.map((country) => (
          <Country key={country.id} country={country} />
        ))}
      </div>
    </div>
  )
}
