const seriaPort = require('serialport')

const port = new seriaPort(
    'COM4',
    {baudRate: 9600}
)

const parser = new seriaPort.parsers.Readline()

port.pipe(parser)

parser.on('data',(line)=>{
    console.log(line)
})

