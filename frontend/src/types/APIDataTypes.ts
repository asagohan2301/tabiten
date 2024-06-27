export type Area = {
  id: number
  order: number
  area_name: string
  countries: Country[]
}

export type Country = {
  id: number
  country_name: string
  reading: string
  cities: City[]
}

export type City = {
  id: number
  city_name: string
  reading: string
}

export type Weathers = {
  date: string[]
  weather_code: number[]
  category: string[]
  description: string[]
  temp_max: number[]
  temp_min: number[]
  precipitation_probability: number[]
}
