import {
  BrightnessHigh,
  CloudRain,
  Cloudy,
  Lightning,
  Snow,
} from 'react-bootstrap-icons'

export default function WeatherIconComponent({
  category,
}: {
  category: string
}) {
  const getWeatherIcon = (category: string) => {
    switch (category) {
      case '晴れ':
        return <BrightnessHigh color="#FF9072" size={70} />
      case '曇り':
        return <Cloudy color="#A3D5F6" size={70} />
      case '雨':
        return <CloudRain color="#8C9BC1" size={70} />
      case '雪':
        return <Snow color="royalblue" size={70} />
      case '雷雨':
        return <Lightning color="#FFDD69" size={70} />
    }
  }

  return <>{getWeatherIcon(category)}</>
}
